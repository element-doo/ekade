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

	col := session.DB("Kada").C("Slike")

	app := ripple.NewApplication()
	picController := NewPictureController(col)
	app.RegisterController("Kada", picController)
	app.AddRoute(ripple.Route{Pattern: ":_controller/:guid/Slike"})
	app.AddRoute(ripple.Route{Pattern: ":_controller/:guid/Slike/:type"})
//	app.AddRoute(ripple.Route{Pattern: ":_controller/all/:type"})
//	app.AddRoute(ripple.Route{Pattern: ":_controller"})

	app.SetBaseUrl("/")
	http.HandleFunc("/", app.ServeHTTP)

	port := "10080"
	log.Println("Starting server @ " + port)
	http.ListenAndServe(":" + port, nil)
}
