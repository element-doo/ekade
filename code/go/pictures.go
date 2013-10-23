package main

import (
	"encoding/json"
	"fmt"
	"io/ioutil"
	"labix.org/v2/mgo"
	"labix.org/v2/mgo/bson"
	"net/http"
	"ripple"
)

type Picture struct {
	Id   bson.ObjectId "_id,omitempty"
	Data string
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

	if ctx.Params["id"] != "" {
		if bson.IsObjectIdHex(ctx.Params["id"]) {
			picId := bson.ObjectIdHex(ctx.Params["id"])
			var result Picture
			err := this.col.FindId(picId).One(&result)
			if err != nil {
				ctx.Response.Body = err
			} else {
				ctx.Response.Body = result
			}
		} else {
			// ?? 422 Unprocessable Entity is returned if the ID of a resource that is specified in the request body cannot be resolved.
			ctx.Response.Status = http.StatusNotFound
		}
	} else {
		var result []Picture
		err := this.col.Find(nil).All(&result)
		if err != nil {
			ctx.Response.Body = err
		} else {
			ctx.Response.Body = result
		}
	}
}

func (this *PictureController) Post(ctx *ripple.Context) {
	body, _ := ioutil.ReadAll(ctx.Request.Body)
	var pic Picture
	json.Unmarshal(body, &pic)
	info, _ := this.col.Upsert(pic, pic)
	fmt.Println(info)
	ctx.Response.Body = pic
}

func (this *PictureController) Put(ctx *ripple.Context) {
	body, _ := ioutil.ReadAll(ctx.Request.Body)
	var pic Picture
	json.Unmarshal(body, &pic)
	this.col.Upsert(pic, pic)
	ctx.Response.Body = pic
}

func (this *PictureController) Delete(ctx *ripple.Context) {
	if ctx.Params["id"] != "" {
		if bson.IsObjectIdHex(ctx.Params["id"]) {
			picId := bson.ObjectIdHex(ctx.Params["id"])
			err := this.col.RemoveId(picId)
			if err != nil {
				ctx.Response.Body = err
			} else {
				ctx.Response.Status = http.StatusOK
			}
		} else {
			// ?? 422 Unprocessable Entity is returned if the ID of a resource that is specified in the request body cannot be resolved.
			ctx.Response.Status = http.StatusNotFound
		}
	}
}
