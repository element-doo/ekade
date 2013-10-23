package main

import (
	"labix.org/v2/mgo"
	"log"
	"net/http"
	"ripple"
)

func main() {
	session, err := mgo.Dial("localhost")
	if err != nil {
		log.Fatal(err)
	}
	defer session.Close()

	col := session.DB("kada").C("pics")

	app := ripple.NewApplication()
	picController := NewPictureController(col)
	app.RegisterController("pictures", picController)
	app.AddRoute(ripple.Route{Pattern: ":_controller/all/:type"})
	app.AddRoute(ripple.Route{Pattern: ":_controller/:guid/:type"})
	app.AddRoute(ripple.Route{Pattern: ":_controller/:guid"})
	app.AddRoute(ripple.Route{Pattern: ":_controller"})

	app.SetBaseUrl("/api/")
	http.HandleFunc("/api/", app.ServeHTTP)

	log.Println("Starting server...")
	http.ListenAndServe(":8080", nil)

}
