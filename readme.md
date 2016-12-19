#P4 | Ashley Davis | DWA15-Fall2016

#Description
This app will serve as a library for hard copies of movies that can be loaned out to users. It will allow administrator users to manage a database of films that are in their possession. End users will be able to view movie titles that are available along with a description of the movies with registered users able to checkout/place a hold on the titles, recommend movies for purchase, and create “themed” lists of movies to share with other users (e.g., “my favorite superhero films”, “classic films you must watch before you die”, etc).


#Live URL
<http://p4.andmade.me>

#Screencast
<https://www.youtube.com/watch?v=RNGPyxr5Fb4> 

#Planning Doc
<https://docs.google.com/document/d/1u8zU6ba9saAiWIMrjun6TdW97a7o7P37QwHFgDi1IgA/edit#>

#Notes For TA
On occassion, the MovieTableSeeder will fail as a result of an error with the Image package not being able to grab the image. It happens very rarely, but I did want to mention it!

Overall, some feature-creep came in and I ended up having to cut down adding some things that I wanted (such as adding in the ability to edit MovieMixes) in order to meet the basic requiements fully.

CRUD Interactions:
All CRUD-y functions can be performed by administrators on the movies database. 

#Resources
+ **Ink Framework** - <http://ink.sapo.pt/>
+ **Google Fonts: Muli** - <https://fonts.google.com/>
+ **Jleagle/omdb-imdb-api-client Package** - <https://github.com/Jleagle/omdb-imdb-api-client> (Used to retrieve results from the Open Movie Database)
+ **intervention/image Package** - <http://image.intervention.io/> (Used to download and retrieve movie poster images)
+ **Laravel: Authorization - Policies** - <https://laravel.com/docs/5.3/authorization> (Used to keep regular users away from admin functions)
+ **IconFinder** - <https://www.iconfinder.com/icons/110995/film_movie_icon#size=128> (source of film reel used in logo)