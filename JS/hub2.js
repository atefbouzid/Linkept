// Remove this line:
// var auteurInput = document.querySelector('.Auteur');

var btnPublier = document.querySelector('.btn-publier input');
var postInput = document.querySelector('.Post');
var latestPosts = document.querySelector('.latest');


btnPublier.addEventListener('click', function() {
    var postText = postInput.value;
  
    if (postText !== '') {
      var now = new Date();
      var formattedDate = now.toLocaleDateString('fr-FR');
  
      // Fetch the author name from the backend
      fetch('/api/get-author')
        .then(response => response.json())
        .then(author => {
          var newPost = document.createElement('div');
          newPost.classList.add('post-area');
          newPost.innerHTML = `
          <div class='post-area'>
            <div class="post">
              <div style="font-size:20px;
              font-weight: 700;
              font-family: "Roboto Slab", "Times New Roman", serif;" class="name">${author} 
              <p style="margin-top: 0px;;
              font-size:14px;
              font-weight: 550;
              font-family: "Roboto Slab", "Times New Roman", serif;" class="name">&nbsp; Statut </p> </div>
              ${postText}
              <p><span style="align-items=left;" class="date1">${formattedDate}</span></p>
              <hr>
              <div class="post-footer">
                <button class="up"><i class="fa-solid fa-up-long fa-bounce"></i> UP&nbsp;<span>2</span></button>
              </div>
            </div>
          </div>
          `;
          
          latestPosts.insertBefore(newPost, latestPosts.firstElementChild)
          postInput.value = '';
        })
        .catch(error => {
          console.error(error);
        });
    }
  });

document.addEventListener('click', (event) => {
    if (event.target && event.target.matches('.up')) {
      const likesCount = event.target.querySelector('span');
      let likes = parseInt(likesCount.textContent);
      likes++;
      likesCount.textContent = likes;
    }
  });
  
