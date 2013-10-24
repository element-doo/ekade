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

	col := session.DB("Kada").C("Slike")

	app := ripple.NewApplication()
	picController := NewPictureController(col)
	app.RegisterController("Kada", picController)
	app.AddRoute(ripple.Route{Pattern: ":_controller/:guid/Slike"})
	app.AddRoute(ripple.Route{Pattern: ":_controller/:guid/Slike/:type"})

	app.SetBaseUrl("/")
	http.HandleFunc("/", app.ServeHTTP)

	servePic := ripple.NewApplication()
	servePicController := NewServePictureController(col)
	servePic.RegisterController("pic", servePicController)
	servePic.AddRoute(ripple.Route{Pattern: ":_controller/:guid/:type"})
	servePic.SetBaseUrl("/serve/")
	servePic.SetContType("image/jpeg")
	http.HandleFunc("/serve/", servePic.ServeHTTP)

	port := "10080"
	log.Println("Starting server @ " + port)
	http.ListenAndServe(":"+port, nil)
}
