


document.addEventListener('DOMContentLoaded', function(){
    

    //const searchBtn = document.getElementById("searchBtn");
   // const searchBox = document.querySelector(".search_box");
   
    const LoadingScreen = document.getElementById("screenloading");
    const LoadingLogo = document.getElementById("loadinglogo");
    const body= document.body;

    // Sets up color-changing animation for the loading logo
    body.classList.add("loading");


    setTimeout(function(){

        LoadingScreen.style.display = "none";
        LoadingLogo.style.display ="none";
        body.classList.remove("loading");


    }, 2000); 


    const MenuBtn = document.getElementById("menubtn");
    const MainNav = document.getElementById("mainNav");


    MenuBtn.addEventListener("click", function(){

        MainNav.classList.toggle("active");

        //Checks if the menu is active
        const IsActive = MainNav.classList.contains("active");

        // If the menu is active add search and basket buttons
        if (IsActive){

        addDynamicBtn();

        }
    
        else{

        removeDynamicBtn();

        }
             

  });
    
  
    /*
    SearchBtn.addEventListener("click", function(event){

        event.preventDefault();

    */

    function addDynamicBtn() {
        removeDynamicBtn(); // Removes existing dynamic buttons before adding new one
    
    // Creates women button
    const womenButton = document.createElement('li');
    womenButton.innerHTML = '<a href="women.php" class="icon-btn" id="womenbtn">WOMEN</a>';

    // Creates men button
    const menButton = document.createElement('li');
    menButton.innerHTML = '<a href="men.php" class="icon-btn" id="menbtn">MEN</a>';

    // Creates girls button
    const girlsButton = document.createElement('li');
    girlsButton.innerHTML = '<a href="girls.php" class="icon-btn" id="girlsbtn">GIRLS</a>';

    // Creates boys button
    const boysButton = document.createElement('li');
    boysButton.innerHTML = '<a href="boys.php" class="icon-btn" id="boysbtn">BOYS</a>';

    // Creates infants button
    const babiesButton = document.createElement('li');
    babiesButton.innerHTML = '<a href="babies.php" class="icon-btn" id="babiesbtn">BABIES</a>';

    // Creates accessories button
    const accessoriesButton = document.createElement('li');
    accessoriesButton.innerHTML = '<a href="accessories.php" class="icon-btn" id="accessoriesbtn">ACCESSORIES</a>';


    // Append the buttons to the menu
    MenuBtn.appendChild(womenButton);
    MenuBtn.appendChild(menButton);
    MenuBtn.appendChild(girlsButton);
    MenuBtn.appendChild(boysButton);
    MenuBtn.appendChild(babiesButton);
    MenuBtn.appendChild(accessoriesButton);

   }
    
    function removeDynamicBtn() {
        // Removes the added buttons
        const dynamicWomenBtn = document.getElementById('womenbtn');
        const dynamicMenBtn = document.getElementById('menbtn');
        const dynamicGirlsBtn = document.getElementById('girlsbtn');
        const dynamicBoysBtn = document.getElementById('boysbtn');
        const dynamicBabiesBtn = document.getElementById('babiesbtn');
        const dynamicAccessoriesBtn = document.getElementById('accessoriesButton');
     
        if (dynamicWomenBtn) {
            dynamicWomenBtn.parentNode.remove();
        }

        if (dynamicMenBtn) {
            dynamicMenBtn.parentNode.remove();
        }
    
        if (dynamicGirlsBtn) {
            dynamicGirlsBtn.parentNode.remove();
        }

        if (dynamicBoysBtn) {
            dynamicBoysBtn.parentNode.remove();
        }

        if (dynamicBabiesBtn) {
            dynamicBabiesBtn.parentNode.remove();
        }

        if (dynamicAccessoriesBtn) {
            dynamicAccessoriesBtn.parentNode.remove();
        }

    }


    function areDynamicButtonsAdded() {
        // Checks if the dynamic buttons are already present
        return document.getElementById('womenbtn') !== null && document.getElementById('menbtn') !== null && document.getElementById('girlsbtn') !== null && document.getElementById('boysbtn') !== null && document.getElementById('babiesbtn') !== null && document.getElementById('accessoriesbtn') !== null;
    }

});
















