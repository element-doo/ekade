package main

import (
	"./labix.org/v2/mgo"
	"./labix.org/v2/mgo/bson"
	"./ripple"
	"encoding/json"
	"fmt"
	"io/ioutil"
	"net/http"
)

type Picture struct {
	Id        bson.ObjectId "_id,omitempty"
	GUID      string        `json:"guid,omitempty"`
	Thumbnail string        `json:"thumbnail,omitempty"`
	Original  string        `json:"original,omitempty"`
	Email     string        `json:"email,omitempty"`
	Web       string        `json:"web,omitempty"`
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
	var g = ctx.Params["guid"]
	var t = ctx.Params["type"]

	if len(g) > 0 {
		var result *Picture
		query := this.col.Find(bson.M{"guid": g})
		if len(t) > 0 {
			if t != "all" {
				query.Select(bson.M{"guid": 1, t: 1})
			}
		}
		err := query.One(&result)
		if err != nil {
			ctx.Response.Body = err
		} else {
			ctx.Response.Body = result
		}
	} else {
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
	}

}

func (this *PictureController) postPut(ctx *ripple.Context) {
	var g = ctx.Params["guid"]
	body, _ := ioutil.ReadAll(ctx.Request.Body)
	if len(g) > 0 {

		var pic = Picture{GUID: g}
		json.Unmarshal(body, &pic)

		var result *Picture

		this.col.Find(bson.M{"guid": g}).One(&result)

		if result != nil {
			fmt.Println("update:")
			this.col.Update(bson.M{"guid": g}, pic)
		} else {
			fmt.Println("insert:")
			this.col.Upsert(pic, pic)
		}
		ctx.Response.Status = http.StatusOK
		ctx.Response.Body = pic

	} else {
		ctx.Response.Status = http.StatusNotFound
	}
}

func (this *PictureController) Post(ctx *ripple.Context) {
	this.postPut(ctx)
}

func (this *PictureController) Put(ctx *ripple.Context) {
	this.postPut(ctx)
}

func (this *PictureController) Delete(ctx *ripple.Context) {
	var g = ctx.Params["guid"]
	if len(g) > 0 {
		err := this.col.Remove(bson.M{"guid": g})
		if err != nil {
			ctx.Response.Body = err
		} else {
			ctx.Response.Status = http.StatusOK
		}
	} else {
		ctx.Response.Status = http.StatusNotFound
	}
}
