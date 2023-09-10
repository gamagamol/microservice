package main

import (
	"fmt"
	"golang/entity"
	"golang/repo"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/cors"
)


func main(){
	app:=fiber.New()
	app.Use(cors.New())

	// Or extend your config for customization
	app.Use(cors.New(cors.Config{
		AllowOrigins: "*",
		AllowHeaders:  "Origin, Content-Type, Accept",
	}))


	app.Get("/",func(c *fiber.Ctx) error {
	students,_:=repo.NewRepo().GetAll()
		return c.Status(200).JSON(fiber.Map{
			"Message":"message from golang",
			"students":students,
		})
	})

	app.Post("/",func (c *fiber.Ctx)error  {
		var student entity.Students

		if err := c.BodyParser(&student); err != nil {
			fmt.Println(err)
        return c.Status(400).JSON(fiber.Map{"message": "Invalid Request"})
   	 }

	 if err:=repo.NewRepo().Insert(student);err!=nil{
		fmt.Println(err)
        return c.Status(400).JSON(fiber.Map{"message": "Invalid Request"})
	 }
		 

		return c.Status(200).JSON(fiber.Map{
			"message":"success",
		})
	})

	app.Listen(":3002")
}