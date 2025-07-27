document.addEventListener("DOMContentLoaded", function(){
    const form=document.getElementById("searchForm");

    // if(form){
    form.addEventListener("submit", function(event){
        event.preventDefault();
    
    
        const city=document.getElementById("city").value;
        const bloodGroup=document.getElementById("blood_group").value;

    


        fetch("search.php",{
            method: "POST",
            headers:{
                "content-Type": "application/x-www-form-urlencoded"
            },
            body: `city=${encodeURIComponent(city)}&blood_group=${encodeURIComponent(bloodGroup)}`
        })
        .then(response=>response.text())
        .then(data=>{
            document.getElementById("result").innerHTML=data;
        })
        .catch(error=>{
            console.error("Error:",error);
       
        });
    });
});



