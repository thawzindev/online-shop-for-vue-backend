<div class="modal fade" id="{{ $modal }}">
    <div class="modal-dialog">
      <div class="modal-content">    
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">{{ $header }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>     
        <!-- Modal body -->
        <div class="modal-body">
          {{ $body }}
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
           <form action="" id="{{ $confirm }}" method="POST" 
            class="d-inline">
              @csrf
              @method($method)
              <button type="submit" class="btn btn-{{ $button_color }}">{{ $button_text }}</button>
          </form>
        </div>
      </div>
    </div>
</div>