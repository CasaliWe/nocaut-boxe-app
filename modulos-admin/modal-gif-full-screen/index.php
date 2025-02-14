<style>
  #container-img-gif-full-screen {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 85vh;
    width: 85vw; 
  }
  #gif-full-screen {
    max-width: 100%; 
    max-height: 100%;
    object-fit: contain; 
  }

  @media(max-width:992px){
    #container-img-gif-full-screen {
      height: 98vh;
      width: 98vw; 
    }
  }
</style>


<!-- modal gif full -->
<div class="modal fade" id="modal-gif-full-screen" tabindex="-1" aria-labelledby="modal-gif-full-screen" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="w-100 d-flex justify-content-center">
              
        <div id="container-img-gif-full-screen">
            <img id="gif-full-screen">
        </div>

    </div>
  </div>
</div>
<!-- modal gif full -->