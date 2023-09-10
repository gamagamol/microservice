package entity

type Students struct{
	Id 		int `json:"id,omitempty"`
	Name	string `json:"name"`
	Progamming string `json:"progamming"`
}