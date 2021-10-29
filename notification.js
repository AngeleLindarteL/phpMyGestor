if(document.querySelector(".notification")){
    const notif = document.querySelector(".notification");
    setTimeout(() => {
        notif.style.opacity = "100%";
        notif.style.top = "2%";
    },20)
    setTimeout(() => {
        notif.style.top = "5%";
        notif.style.opacity = "0%";
    }, 3000)
    setTimeout(() => {
        document.querySelector("body").removeChild(notif);
    }, 3200)
}