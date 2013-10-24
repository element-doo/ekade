package main

import (
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
	var g = ctx.Params["guid"]
	var t = ctx.Params["type"]

	if len(g) > 0 && len(t) > 0 {
		var result *Picture
		var lwrType = strings.ToLower(t)
		err := this.col.Find(bson.M{"guid": g}).Select(bson.M{"guid": 1, lwrType: 1}).One(&result)
		if err != nil {
			ctx.Response.Body = err
		} else {
			var str = getField(result, t)
			ctx.Response.Body = str
		}
	} else {
		ctx.Response.Status = http.StatusNotFound
	}
}

func getField(p *Picture, field string) string {
	r := reflect.ValueOf(p)
	f := reflect.Indirect(r).FieldByName(field)
	return f.String()
}
