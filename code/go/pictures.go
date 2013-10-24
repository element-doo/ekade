package main

import (
	"./labix.org/v2/mgo"
	"./labix.org/v2/mgo/bson"
	"./ripple"
	"encoding/json"
	"fmt"
	"github.com/nu7hatch/gouuid"
	"io/ioutil"
	"net/http"
	"strings"
)

type Picture struct {
	Id        bson.ObjectId "_id,omitempty"
	GUID      string        `json:"guid,omitempty"`
	Original  []byte        `json:"original,omitempty"`
	Thumbnail []byte        `json:"thumbnail,omitempty"`
	Email     []byte        `json:"email,omitempty"`
	Web       []byte        `json:"web,omitempty"`
}

type PictureController struct {
	col *mgo.Collection
}

func NewPictureController(col *mgo.Collection) *PictureController {
	pc := new(PictureController)
	pc.col = col
	return pc
}

func (this *PictureController) Get(ctx *ripple.Context) {
	var ug = ctx.Params["guid"]
	var t = ctx.Params["type"]

	if len(ug) > 0 {
		u, err := uuid.ParseHex(strings.ToLower(ug))
		if err != nil {
			ctx.Response.Body = "Invalid kadaID!"
			ctx.Response.Status = http.StatusBadRequest
		} else {
			g := u.String()

			var result *Picture
			query := this.col.Find(bson.M{"guid": g})
			if len(t) > 0 {
				query.Select(bson.M{"guid": 1, t: 1})
			}
			err := query.One(&result)
			if err != nil {
				ctx.Response.Status = http.StatusNotFound
				ctx.Response.Body = err
			} else {
				ctx.Response.Status = http.StatusOK

				if len(t) == 0 {
					ctx.Response.Body = result
				} else {
					// Nemam blage o Gou, ovo se vjerojatno moze bolje, no
					// glavni problem nije u ovom switchu već u Rippleovom
					// Context.Response-u koji izgleda da sve želi pretvorit u
					// "application/json". Ovo nam nikako ne paše pošto želimo
					// binary output, a ne Base64 enkodirani JSON string
					// See: https://github.com/laurent22/ripple/blob/master/ripple.go
					// - Marko

					switch t {
					case "original":
						ctx.Response.Body = result.Original
					case "thumbnail":
						ctx.Response.Body = result.Thumbnail
					case "email":
						ctx.Response.Body = result.Email
					case "web":
						ctx.Response.Body = result.Web
					default:
						panic("Impossibulj?!")
					}
				}
			}
		}
	} /* else {
		var result []Picture
		query := this.col.Find(nil)
		if len(t) > 0 {
			if t != "all" {
				query.Select(bson.M{"guid": 1, t: 1})
			}
		}
		err := query.All(&result)
		if err != nil {
			ctx.Response.Body = err
		} else {
			ctx.Response.Body = result
		}
	} */
}

func (this *PictureController) postPut(ctx *ripple.Context) {
	var ug = ctx.Params["guid"]
	body, _ := ioutil.ReadAll(ctx.Request.Body)

	if len(ug) > 0 {
		u, err := uuid.ParseHex(strings.ToLower(ug))
		if err != nil {
			ctx.Response.Body = "Invalid kadaID!"
			ctx.Response.Status = http.StatusBadRequest
		} else {
			g := u.String()

			var pic = Picture{GUID: g}
			json.Unmarshal(body, &pic)

			var result *Picture
			this.col.Find(bson.M{"guid": g}).One(&result)

			if result != nil {
				fmt.Println("update: ", g)
				this.col.Update(bson.M{"guid": g}, pic)
			} else {
				fmt.Println("insert: ", g)
				this.col.Upsert(pic, pic)
			}

			ctx.Response.Status = http.StatusOK
		}
	} else {
		ctx.Response.Status = http.StatusBadRequest
	}
}

func (this *PictureController) Post(ctx *ripple.Context) {
	this.postPut(ctx)
}

func (this *PictureController) Put(ctx *ripple.Context) {
	this.postPut(ctx)
}

func (this *PictureController) Delete(ctx *ripple.Context) {
	// Možda kad bih znao napisati funkciju u Gou
	// ovo nebi bilo tragično copy-pasteano tri puta
	// - Marko

	var ug = ctx.Params["guid"]
	if len(ug) > 0 {
		u, err := uuid.ParseHex(strings.ToLower(ug))
		if err != nil {
			ctx.Response.Body = "Invalid kadaID!"
			ctx.Response.Status = http.StatusBadRequest
		} else {
			g := u.String()

			err := this.col.Remove(bson.M{"guid": g})
			if err != nil {
				ctx.Response.Body = err
				ctx.Response.Status = http.StatusNotFound
			} else {
				ctx.Response.Status = http.StatusOK
			}
		}
	} else {
		ctx.Response.Status = http.StatusBadRequest
	}
}
