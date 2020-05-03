document.getElementById("btnSendPrivateMessage").addEventListener("click", function (e) {
    e.preventDefault();

    let chatId = this.dataset.chatid;
    let text = document.querySelector('#privateMessageText').value;
    
    //sent to DB
    let formData = new FormData();

    formData.append("text_message", text);
    formData.append("chat_id", chatId);
    
    fetch("ajax/saveMessage.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        console.log("Success:", result);
    })
    .catch(error => {
        console.error("Error:", error);
    });
});

