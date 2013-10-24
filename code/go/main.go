package main

import (
	"./labix.org/v2/mgo"
	"./ripple"
	"log"
	"net/http"
)

func main() {
	session, err := mgo.Dial("localhost")
	if err != nil {
		log.Fatal(err)
	}
	defer session.Close()

	col := session.DB("Kade").C("Slike")

	app := ripple.NewApplication()
	picController := NewPictureController(col)
	app.RegisterController("Kada", picController)
	app.AddRoute(ripple.Route{Pattern: ":_controller/:kadaID/Slike"})
	app.AddRoute(ripple.Route{Pattern: ":_controller/:kadaID/Slike/:type"})
	app.SetBaseUrl("/crud/")
	http.HandleFunc("/crud/", app.ServeHTTP)

	servePic := ripple.NewApplication()
	servePicController := NewServePictureController(col)
	servePic.RegisterController("Slike", servePicController)
	servePic.AddRoute(ripple.Route{Pattern: ":_controller/:kadaID/:type"})
	servePic.SetContType("image/jpeg")
	servePic.SetBaseUrl("/public/")
	http.HandleFunc("/public/", servePic.ServeHTTP)

	port := "10080"
	log.Println("Starting server @ " + port)
	http.ListenAndServe(":"+port, nil)
}
