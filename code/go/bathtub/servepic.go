package main

import (
	"./github.com/nu7hatch/gouuid"
	"./labix.org/v2/mgo"
	"./labix.org/v2/mgo/bson"
	"./ripple"
	"net/http"
	"reflect"
	"strings"
)

type ServePictureController struct {
	col *mgo.Collection
}

func NewServePictureController(col *mgo.Collection) *ServePictureController {
	pc := new(ServePictureController)
	pc.col = col
	return pc
}

func (this *ServePictureController) Get(ctx *ripple.Context) {
	var ug = ctx.Params["kadaID"]
	var t = ctx.Params["type"]

	if len(ug) > 0 && len(t) > 0 {
		u, err := uuid.ParseHex(strings.ToLower(ug))
		if err != nil {
			ctx.Response.Body = "Invalid kadaID!"
			ctx.Response.Status = http.StatusBadRequest
		} else {
			g := u.String()
			
			var result *Picture
			var lwrType = strings.ToLower(t)

			err := this.col.Find(bson.M{"kadaid": g}).
				Select(bson.M{"kadaid": 1, lwrType: 1}).
				One(&result)
			
			if err != nil {
				ctx.Response.Body = err
				ctx.Response.Status = http.StatusNotFound
			} else {
				var bytes = getField(result, t)
				ctx.Response.Body = bytes
				ctx.Response.Status = http.StatusOK
			}
		}
	} else {
		ctx.Response.Status = http.StatusNotFound
	}
}

func getField(p *Picture, field string) []byte {
	r := reflect.ValueOf(p)
	f := reflect.Indirect(r).FieldByName(field)
	return f.Bytes()
}
