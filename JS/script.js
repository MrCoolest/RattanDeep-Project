const top_books = document.getElementById('top_books');
const top_books_title = document.getElementById("top_books_title");
const search_input = document.getElementById('search_input'); 
const search_btn = document.getElementById('search_btn'); 

 books();
 function books(){
     data = fetch('https://api.nytimes.com/svc/books/v3/lists/current/hardcover-fiction.json?api-key=AhNJgkwRhXChAAfxXwdM6um2TyuSnwqi')
          .then(async (res)=>{
               const result = await res.json();
               topBooksDisplay(result.results.books)
          });
}

function topBooksDisplay(data){

     top_books_title.textContent = `Weekly top ${data.length} Books`


     data.forEach(ele => {
          const div = document.createElement("div");
          div.setAttribute('class','col-md-4');
          div.innerHTML = `<div class='card mb-4 box-shadow'>
          <img class='card-img-top' src='${ele.book_image}' alt='Card image cap'>
          <div class='card-body'>
          <p class"text-dark"><b> Title : ${ele.title} </b></p>
          <p> Author : ${ele.author} </p>
            <p class='card-text'> Description : ${ele.description}</p>
            <div class='d-flex justify-content-between align-items-center'>
              <div class='btn-group'>
                <a href="${ele.buy_links[0].url}" class='btn btn-sm btn-outline-secondary'> ${ele.buy_links[0].name} </a>
                <a href="${ele.buy_links[1].url}" class='btn btn-sm btn-outline-secondary'> ${ele.buy_links[1].name} </a>
               
              </div>
              <small class='text-muted'>9 mins</small>
            </div>
          </div>
        </div>`;
       
          top_books.appendChild(div);

     });
}


search_btn.addEventListener('click',async()=>{
  console.log(search_input.value);
  // https://api.nytimes.com/svc/search/v2/articlesearch.json?q=election&api-key=yourkey
  const val = search_input.value;
  if(val!=""){
    const resp = await fetch(`https://api.nytimes.com/svc/search/v2/articlesearch.json?q=${val}&api-key=AhNJgkwRhXChAAfxXwdM6um2TyuSnwqi`)
    const data = await resp.json();
    console.log(data.response.docs)

  }


})


