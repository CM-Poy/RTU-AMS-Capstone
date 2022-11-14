document.querySelector("#addclass").addEventListener("click",function{
document.querySelector(".whole").classList.add("active");
});
document.querySelector(".whole .closebtn").addEventListener("click",function(){
document.querySelector(".whole").classList.remove("active");
});