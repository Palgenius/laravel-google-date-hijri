# laravel-google-date-hijri
get hijri date from google search then respose it as JSON

   

to use it , :+1: <br />
add HijriController in your project's Controllers directory , <br />
then set get Route in   project's routes as like : <br />
  [X] Route::get('/hijri/{date}','HijriController@getHijriDate');
  
  
 <br />
 <br />
__response show return__ <br />
{ <br />
year	:"١١", <br />
month	:"محرم", <br />
day	:"١٤٤١" <br />
}


