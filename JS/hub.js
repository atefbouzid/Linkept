var btnPublier = document.querySelector('.btn-publier input');
var postInput = document.querySelector('.Post');
var auteurInput = document.querySelector('.Auteur');
var latestPosts = document.querySelector('.latest');

function showTime(){
  var date = new Date();
  var h = date.getHours(); // 0 - 23
  var m = date.getMinutes(); // 0 - 59
  var s = date.getSeconds(); // 0 - 59
  var session = "AM";
  
  if(h == 0){
      h = 12;
  }
  
  if(h > 12){
      h = h - 12;
      session = "PM";
  }
  
  h = (h < 10) ? "0" + h : h;
  m = (m < 10) ? "0" + m : m;
  s = (s < 10) ? "0" + s : s;
  
  var time = h + ":" + m + ":" + s + " " + session;
  document.getElementById("MyClockDisplay").innerText = time;
  document.getElementById("MyClockDisplay").textContent = time;
  
  setTimeout(showTime, 1000);
  
}

showTime();

btnPublier.addEventListener('click', function() {
  var postText = postInput.value;
  var auteurText = auteurInput.value;

  if (postText !== '') {
    var now = new Date();
    var formattedDate = now.toLocaleDateString('fr-FR');
    
    var newPost = document.createElement('div');
    newPost.classList.add('post-area');
    newPost.innerHTML = `
    <div class='post-area'>
      <div class="post">
        <div style="font-size:20px;
        font-weight: 700;
        font-family: "Roboto Slab", "Times New Roman", serif;" class="name">${auteurText} 
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
      </div>
    `;
    
    latestPosts.insertBefore(newPost, latestPosts.firstElementChild)
    postInput.value = '';
    auteurInput.value = '';
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
  




