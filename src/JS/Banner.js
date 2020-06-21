var prev = document.getElementsByClassName("arrow arrow_left")[0];
var next = document.getElementsByClassName("arrow arrow_right")[0];
var img = document.getElementById("b_img");
var imgArr = ["../../Image/browse_image1.jpg", "../../Image/browse_image2.jpg", "../../Image/browse_image3.jpg", "../../Image/browse_image4.jpg", "../../Image/browse_image5.jpg"];
var index = 0; //数组下标
var btn = document.getElementsByClassName("b_span"); //返回一个数组
var timer; //定时器的标
var container = document.getElementsByClassName("image1")[0];


prev.onclick = function () {
    index--;
    if (index < 0) {
        index = imgArr.length - 1 //最后一张
    }
    img.src = imgArr[index];
    console.log(img.src);
    setColour();
};


next.onclick = function () {
    index++;
    if (index > imgArr.length - 1) {
        index = 0;
    }
    img.src = imgArr[index];
    setColour();
};

/*
btn[1,2,3,4,5]
第一个是红色，点击第二个时，第一个变绿色，第二个变红色
......
i
index:+1 ---> btn[1] ...
*/
function setColour() {
    for (var i = 0; i < btn.length; i++) {
        btn[i].style.backgroundColor = "";
    }
    btn[index].style.backgroundColor = "red";
}

function autoPlay() {
    timer = setInterval(function () {
        index++;
        if (index > imgArr.length - 1) {
            index = 0;
        }
        img.src = imgArr[index];
        setColour();
    }, 2000);
}
autoPlay();

container.onmousemove = function () {
    clearInterval(timer);
};
container.onmouseout = function () {
    autoPlay();
};

for (var i = 0; i < btn.length; i++) {
    btn[i].num = i;
    btn[i].onclick = function () {
        index = this.num;
        img.src = imgArr[index];
        setColour();
    };
}