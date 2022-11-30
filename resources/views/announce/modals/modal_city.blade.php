<!-- Button trigger modal -->
<ul class="list-group" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <li class="list-group-item shadow-sm  col-12= d-flex border-0 pt-2 ps-3">
      <div class="col-1 m-auto">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gray" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
          </svg>
      </div>
     
      <div class="col-10 text-black-50">
        <div class="">
          <label for="floatingSelect">Şəhər</label>
          <span class="text-danger text-opacity-75 ps-1">*</span>
        </div>
        
        <span class="text-dark fs-5">Bakı</span>
      </div>
      
      <div class="col-1 text-end m-auto">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" fill="gray" class="bi bi-chevron-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
      </div>
    
    </li>
</ul>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>