const topHeader = document.getElementById("topHeader");
const stickyHeader = document.getElementById("stickyHeader");

window.addEventListener("scroll", () => {

    if(window.scrollY > 100){

        topHeader.classList.add("hide");

        stickyHeader.classList.add("fixed");

    }else{

        topHeader.classList.remove("hide");

        stickyHeader.classList.remove("fixed");

    }

});