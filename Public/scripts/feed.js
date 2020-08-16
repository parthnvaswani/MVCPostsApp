getPosts();


async function addPost(e) {
  e.preventDefault();
  let res = await fetch("../index.php?act=addPost", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8",
    },
    body: `content=${document.querySelector("#content").value}`,
  });
  document.querySelector("#content").value = "";
  getPosts();
}

async function getPosts() {
  try {
    let res = await fetch("../index.php?act=getPosts");
    if (res.ok) {
      let json = await res.json();
      displayPosts(json);
    } else {
      console.log("HTTP-Error: " + res.status);
    }
  } catch (e) {
    console.log(e);
  }
}

function displayPosts(json) {
  let postsContainer = document.querySelector(".posts");
  postsContainer.innerHTML = "";
  let text = "";
  json.forEach((e) => {
    text += `<div class="card card-body mb-3">
              <div class="row">
                <div class="col-md-2">
                  <p class="text-center"><b>${e.username}</b></p>
                </div>`;
    if (e.username === user) {
      text += `<button type="button" class="btn btn-danger mr-1" data-id="${e.id}" style="margin-left:auto;" onclick="deletePost(event);">
                    <div class="deletebtn">
      <i class="fas fa-times" ></i>
      </div>
                  </button>`;
    }
    text += `<div class="col-md-10">
                  
                  <p class="lead">${e.content}</p>
                   
                </div>
              </div>
              </div>`;
  });
  postsContainer.innerHTML = text;
}

async function deletePost(e) {
  let id = await e.target.dataset["id"];
  try {
    let res = await fetch("../index.php?act=deletePost&id=" + id);
    getPosts();
  } catch (e) {
    console.log(e);
  }
}
