package repo

import (
	"fmt"
	"golang/entity"
	"log"
	"os"

	"github.com/joho/godotenv"
	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)


type repo struct{
	db *gorm.DB
}

func NewRepo()(*repo){
	if err := godotenv.Load(); err != nil {
        log.Fatal("Error loading .env file")
    }

    dsn:=fmt.Sprintf("%s:%s@tcp(%s:%s)/%s",os.Getenv("DB_USERNAME"),os.Getenv("DB_PASSWORD"),os.Getenv("DB_HOST"),os.Getenv("DB_PORT"),os.Getenv("DB_NAME"))



    // Connect to the database
    db, err := gorm.Open(mysql.Open(dsn), &gorm.Config{})
    if err != nil {
        log.Fatal("Failed to connect to the database:", err)
    }

	return &repo{db}
}

func (r *repo)GetAll()([]entity.Students,error){
	var students []entity.Students

	if err:=r.db.Where("progamming","golang").Find(&students).Error;err!=nil{
		return nil,err
	}

	return students,nil
	
}

func(r *repo)Insert(student entity.Students)error{

	if err:=r.db.Create(&student).Error;err!=nil{
		return err
	}
	return nil

}

