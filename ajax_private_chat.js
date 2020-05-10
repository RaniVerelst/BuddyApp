//let chatId = document.getElementById("btnSendPrivateMessage").dataset.chatid;
let chatId = "521";
let messageContainer = document.querySelector(".messages");

window.setTimeout(getNewMessages,500);


// send messages
document.getElementById("btnSendPrivateMessage").addEventListener("click", function (e) {
    e.preventDefault();
    let chatId = this.dataset.chatid;
    let text = document.querySelector('#privateMessageText').value;
    let userName = this.dataset.username;

    let formData = new FormData();
    formData.append("chat_id", chatId);
    formData.append("text_message", text);


    fetch("ajax/saveMessage.php", {
        "method": "POST",
        "dataType": "json",
        "body": formData,
    }
    )
        .then(res => res.text())
        .then(res => {
            try {
                let date = res.slice(80, 94); // date
                newDiv = document.createElement("div");
                newDiv.setAttribute("class", "message-container");
                newDiv.innerHTML = "<p>" + userName + " <span>" + date + "</span></p><p>" + text + "</p>";
                messageContainer.appendChild(newDiv);
            } catch {
                throw Error("Error :(");
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
});

//get all comming messages
function getNewMessages(){

    let messagesData = new FormData();

    messagesData.append("chat_id", 521);
    //get new messages
    
    fetch("ajax/getMessages.php", {
        method: 'POST',
        dataType: 'json',
        body: messagesData
    })
        .then(res => res.text())
        .then(data => {
            console.log(data);
            let cutBeginning = data.slice(50);
            let messages = JSON.parse(cutBeginning);

           if(messages.status == "faild"){
            return false;
           }

            let date = messages.send_on;
            let text = messages.text_message;
            let userName = messages.user_id;

            newDiv = document.createElement("div");
            newDiv.setAttribute("class", "message-container");
            newDiv.innerHTML = "<p>" + userName + " <span>" + date + "</span></p><p>" + text + "</p>";
    
            messageContainer.appendChild(newDiv);
        
        })
        .catch(error => {
            console.error("Error:", error);
        });
    
}
