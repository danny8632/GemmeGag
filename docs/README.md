<p align="center">
  <h1 align="center">GemmeGag Docs</h1>

  <p align="center">Here are the docs for this project</p>
</p>

## Index

* [DataBase structure](#dataBase-structure)
* [File Structure](#file-structure)


## DataBase structure:

Here is our database structure, for now we do only have a “simple” idea about how it’s going to look like.

We are trying to create our database through some of the best practice.
We found this guide, witch we are going to follow [Normalisering af database](https://balslev.io/programmering/database/normalisering-af-databaser/)

Later on there will be added:
* View
* More tables
* More relations

File(s):
[Database diagram pdf](https://github.com/danny8632/GemmeGag/blob/master/docs/GemmegagDB.pdf)


## File Structure

Our file structure is leaning on the MVC(Model View Controller) but not completely.
We splits it up where we have an API part and a Client/Page part.

The API is only responsible for handling data through our database.

The front end is going to rely on the api for handling data and uses php and js for initialization and SPA like experience.


File(s):
[File Structure Diagram pdf](https://github.com/danny8632/GemmeGag/blob/master/docs/fileStructure.pdf)