const e=document.querySelectorAll(".star-2");e.forEach((a,t)=>{a.addEventListener("click",()=>{e.forEach((c,s)=>{t>=s?c.classList.add("active"):c.classList.remove("active")})})});
