/*=========================Check and display if mail is correct for the user=========================*/
function checkMail() {
  let returnValue = "";
  let splitMail = document
    .querySelector("#mail")
    .value.toLowerCase()
    .split("@");
  if (splitMail[1] !== "cf2000.onmicrosoft.com") {
    returnValue = "Votre mail n'est pas un du CF2M!";
  } else {
    if (splitMail[0].split(".").length !== 2) {
      returnValue = "Votre mail n'est pas un du CF2M!";
    } else {
      returnValue = "Votre mail est correct";
    }
  }
  document.querySelector(".validation").style = "display:block;";
  document.querySelector(".validation").innerText = returnValue;
}
if (document.querySelector("#mail")) {
  document.querySelector("#mail").addEventListener("keyup", checkMail);
}
/*=========================Toggle login/Sign in forms=========================*/

function toggleInscription() {
  let login = document.querySelector(".login");
  let inscription = document.querySelector(".inscription");
  login.style.display = login.style.display === "none" ? "block" : "none";
  inscription.style.display =
    inscription.style.display === "none" ? "block" : "none";
}

document
  .querySelectorAll(".toggleForm")
  .forEach((el) => el.addEventListener("click", toggleInscription));

/*=========================Check if pwds matches=========================*/
function checkPasswords() {
  let password1 = document.querySelector("#mdp");
  let password2 = document.querySelector("#mdpConfirm");

  if (password1.value !== password2.value) {
    document.querySelector(".matches").style = "display:block;";
    document.querySelector(".matches").innerText =
      "Vos mots-de-passe ne correspondent pas!";
  } else {
    document.querySelector(".matches").style = "display:none;";
    document.querySelector(".matches").innerText = "";
  }
}
if (document.querySelector("#mdpConfirm")) {
  document
    .querySelector("#mdpConfirm")
    .addEventListener("change", checkPasswords);
}
/*=========================Class Message=========================*/
class Message {
  constructor(id, displayedName, message, date, userId) {
    this.id = id;
    this.displayedName = displayedName;
    this.message = message;
    this.date = date;
    this.userId = userId;
  }

  writeMessage() {
    return `<div id="${this.id}" class="${this.checkAutor()}messageBox">
      <div class="messages">
        <p><span class="name">${this.displayedName}</span></p>
        <p>${this.message.length > 80 ? this.message : this.message}</p>
        <p><span class="date">${this.date}</span></p>
      </div>
    </div>`;
  }
  checkAutor() {
    let whoIsOn = document.querySelector("header p span").id;
    return this.userId == whoIsOn ? "right " : "";
  }
}
/*=========================AJAX=========================*/

/*========Load all messages from DB========*/
if (document.querySelector(".room")) {
  let messagesContainer = document.querySelector(".room article");
  let onlineUsersContainer = document.querySelector(".online");
  let offlineUsersContainer = document.querySelector(".offline");
  let loadMore = document.querySelector(".loadMore");
  $.get(
    "assets/api/loadMessages.php",
    function success(data) {
      if (data.length < 20) {
        loadMore.style.display = "none";
      }
      data.forEach((message) => {
        messagesContainer.insertAdjacentHTML(
          "beforeend",
          new Message(
            message.messages_id,
            message.displayedName,
            message.message,
            message.date,
            message.users_id
          ).writeMessage()
        );
        let scrollTo = document.querySelector(".room article");
        scrollTo.scrollTop = scrollTo.scrollHeight - scrollTo.clientHeight;
      });
    },
    "JSON"
  );

  loadMore.addEventListener("click", () => {
    let messages = document.querySelectorAll(".messageBox");
    messages = Array.from(messages);
    let offsetToLoad = (messages.pop().id - messages.shift().id + 1).toString();
    $.get(
      "assets/api/loadOlderMessages.php",
      offsetToLoad,
      function success(data) {
        if (data.length < 20) {
          loadMore.style.display = "none";
        }
        data.forEach((message) => {
          loadMore.insertAdjacentHTML(
            "afterend",
            new Message(
              message.messages_id,
              message.displayedName,
              message.message,
              message.date,
              message.users_id
            ).writeMessage()
          );
        });
      },
      "JSON"
    );
  }); /*========Load all users from DB========*/
  $.get(
    "assets/api/loadUsers.php",
    function success(data) {
      data.forEach((user) => {
        if (user.online == 1) {
          onlineUsersContainer.insertAdjacentHTML(
            "afterend",
            `<p id="user${user.users_id}" class="users">${user.displayedName}</p>`
          );
        } else {
          offlineUsersContainer.insertAdjacentHTML(
            "afterend",
            `<p id="user${user.users_id}" class="users">${user.displayedName}</p>`
          );
        }
      });
    },
    "JSON"
  );
  /*========Load all messages from DB after last index every 5 secondes========*/

  setInterval(function () {
    let messages = document.querySelectorAll(".messageBox");
    if (messages.length) {
      messages = Array.from(messages);
    }
    $.get(
      "assets/api/loadNewMessages.php",
      messages.length ? messages.pop().id : "0",
      function success(data) {
        data.forEach((message) => {
          messagesContainer.insertAdjacentHTML(
            "beforeend",
            new Message(
              message.messages_id,
              message.displayedName,
              message.message,
              message.date,
              message.users_id
            ).writeMessage()
          );
          let getId = document.querySelector("header p span").id;
          if (message.users_id == getId) {
            let scrollTo = document.querySelector(".room article");
            scrollTo.scrollTop = scrollTo.scrollHeight - scrollTo.clientHeight;
            let displayMessageLength = document.querySelector(
              ".messageLength p span"
            );
            displayMessageLength.innerText = 0;
            $("#message").prop("disabled", false);
            $("#message").focus();
          }
        });
      },
      "JSON"
    );
    /*========Load all users from DB========*/
    $.get(
      "assets/api/loadUsers.php",
      function success(data) {
        let dataUsers = [];
        data.forEach((user) => {
          dataUsers.push(user.users_id);
        });
        let users = document.querySelectorAll(".users");
        let usersCheck = [];
        users.forEach((el) => {
          usersCheck.push(el.id.replace("user", ""));
        });
        usersCheck.forEach((el) => {
          if (!dataUsers.includes(el)) {
            document.querySelector(`#user${el}`).remove();
          }
        });
        data.forEach((user) => {
          if (user.online == 1) {
            if (
              !document.querySelector(
                `.onlineContainer > #user${user.users_id}`
              )
            ) {
              if (document.querySelector(`#user${user.users_id}`)) {
                document.querySelector(`#user${user.users_id}`).remove();
              }
              onlineUsersContainer.insertAdjacentHTML(
                "afterend",
                `<p id="user${user.users_id}" class="users">${user.displayedName}</p>`
              );
            }
          } else {
            if (
              !document.querySelector(
                `.offlineContainer > #user${user.users_id}`
              )
            ) {
              if (document.querySelector(`#user${user.users_id}`)) {
                document.querySelector(`#user${user.users_id}`).remove();
              }
              offlineUsersContainer.insertAdjacentHTML(
                "afterend",
                `<p id="user${user.users_id}" class="users">${user.displayedName}</p>`
              );
            }
          }
        });
      },
      "JSON"
    );
  }, 500);
  /*========post new message to DB========*/
  document.addEventListener("keydown", (event) => {
    let key = event.key;
    if (key === "Enter") {
      event.preventDefault();
      let data = {
        message: document.querySelector("#message").value,
      };
      if (data.message.length) {
        $.post("assets/api/postMessage.php", data, () => {
          $("#message").prop("disabled", true);
        });
        $("#message").val("");
      }
    }
  });
  document.querySelector("#message").addEventListener("keyup", function () {
    let displayMessageLength = document.querySelector(".messageLength p span");
    displayMessageLength.innerText = this.value.length;
  });
}
if (document.querySelector(".admin")) {
  let deleteButton = document.querySelectorAll(".deleteButton");
  let clearMessages = document.querySelector(".clearMessages");
  let displayedName = document.querySelectorAll(".displayedName");

  clearMessages.addEventListener("click", function () {
    this.style.display = "none";
    this.nextElementSibling.style.display = "flex";
  });

  deleteButton.forEach((el) =>
    el.addEventListener("click", function () {
      this.style.display = "none";
      this.nextElementSibling.style.display = "grid";
    })
  );
  displayedName.forEach((el) =>
    el.addEventListener("click", function () {
      this.style.display = "none";
      this.nextElementSibling.style.display = "grid";
    })
  );
}
