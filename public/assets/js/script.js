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
  constructor(id, displayedName, message, date) {
    this.id = id;
    this.displayedName = displayedName;
    this.message = message;
    this.date = date;
  }

  writeMessage() {
    return `<div id="${this.id}" class="${this.checkAutor()} messageBox">
      <div class="messages">
        <p><span class="name">${this.displayedName}</span></p>
        <p>${this.message}</p>
        <p><span class="date">${this.date}</span></p>
      </div>
    </div>`;
  }
  checkAutor() {
    let whoIsOn = document.querySelector("header p span").innerHTML;
    if (this.displayedName == whoIsOn) {
      return "right";
    }
  }
}
/*=========================AJAX=========================*/

/*========Load all messages from DB========*/
if (document.querySelector(".room")) {
  let messagesContainer = document.querySelector(".room article");
  let onlineUsersContainer = document.querySelector(".online");
  let offlineUsersContainer = document.querySelector(".offline");
  $.get(
    "assets/api/loadMessages.php",
    function success(data) {
      data.reverse();
      data.forEach((message) => {
        messagesContainer.insertAdjacentHTML(
          "afterbegin",
          new Message(
            message.messages_id,
            message.displayedName,
            message.message,
            message.date
          ).writeMessage()
        );
        let scrollTo = document.querySelector(".room article");
        scrollTo.scrollTop = scrollTo.scrollHeight - scrollTo.clientHeight;
      });
    },
    "JSON"
  );
  /*========Load all users from DB========*/
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
    $.get(
      "assets/api/loadMessages.php",
      function success(data) {
        let messagesList = document.querySelectorAll(".messageBox");
        if (messagesList.length) {
          var lastId = messagesList[messagesList.length - 1].id;
        } else {
          lastId = -1;
        }
        data.forEach((message) => {
          if (messagesList.length) {
            if (message.messages_id > lastId) {
              messagesList[messagesList.length - 1].insertAdjacentHTML(
                "afterend",
                new Message(
                  message.messages_id,
                  message.displayedName,
                  message.message,
                  message.date
                ).writeMessage()
              );
              let scrollTo = document.querySelector(".room article");
              scrollTo.scrollTop =
                scrollTo.scrollHeight - scrollTo.clientHeight;
            }
          } else {
            messagesContainer.insertAdjacentHTML(
              "afterbegin",
              new Message(
                message.messages_id,
                message.displayedName,
                message.message,
                message.date
              ).writeMessage()
            );
          }
          messagesList = document.querySelectorAll(".messageBox");
          lastId = messagesList[messagesList.length - 1].id;
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
      $.post("assets/api/postMessage.php", data);
      $("#message").val("");
    }
  });
}
if (document.querySelector(".admin")) {
  let deleteButton = document.querySelectorAll(".deleteButton");
  let displayedName = document.querySelectorAll(".displayedName");

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
