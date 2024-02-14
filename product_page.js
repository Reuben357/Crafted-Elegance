let thumbnails = document.getElementsByClassName("thumbnail");

let activeImage = document.getElementsByClassName("active");

for (var i = 0; i < thumbnails.length; i++){

    thumbnails[i].addEventListener("click", function () {
        console.log(activeImage)

        if (activeImage.length > 0) {
            activeImage[0].classList.remove("active")
        }

        this.classList.add("active")
        document.getElementById("product-img").src = this.src
    });
}

//Dropdown

function show(anything){
    document.querySelector('.textBox').value = anything;
}

let dropdown = document.querySelector('.dropdown');
dropdown.onclick = function(){
    dropdown.classList.toggle('active');
}
