<!-- Advanced Search -->
@if(isset($search_filters) && $search_filters)
 <div class="box">
     <div class="box-header">
         <h3 class="box-title">Search</h3>
     </div>
     <div class="box-body">
             <form id="demoform" action="#" method="post">
    <select multiple="multiple" size="10" name="duallistbox_demo1[]">
      <option value="option1">Option 1</option>
      <option value="option2">Option 2</option>
      <option value="option3" selected="selected">Option 3</option>
      <option value="option4">Option 4</option>
      <option value="option5">Option 5</option>
      <option value="option6" selected="selected">Option 6</option>
      <option value="option7">Option 7</option>
      <option value="option8">Option 8</option>
      <option value="option9">Option 9</option>
      <option value="option0">Option 10</option>
    </select>
    <br>
    <button type="submit" class="btn btn-default btn-block">Submit data</button>
  </form>
     </div>
     <div class="box-footer">

         <input type="submit" class="btn btn-primary" name="submit_search" form="search" value="Go">
         &nbsp;
         @if(!empty($applied_filters))
             <a class="btn btn-primary" data-toggle="modal" data-target="#bookmark">Save this search</a>

            <!-- Bookmark section popup -->
           <div class="modal fade" id="bookmark" role="dialog">
                 <div class="modal-dialog">
                       <div class="modal-content">
                             <div class="modal-header model-header-custom">
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <h4 class="modal-title">Add New Bookmark</h4>
                             </div>
                             <div class="modal-body">
                                 <form name="bookmark" id="bookmark" action="/bookmarks/add/" method="post">
                                     <div class="form-group">
                                         <label for="description" class="required">Description:</label>
                                         <input class="form-control" name="description" id="description" value="" size="64" maxlength="128" type="text">
                                     </div>
                                     <div class="form-group">
                                         <div class="checkbox">
                                             <label>
                                                 <input name="shared" id="shared" value="1" type="checkbox">Share this search with all users?
                                             </label>
                                          </div>
                                     </div>
                                     <input name="url" id="url" value="" size="128" maxlength="512" type="hidden">
                                 </form>
                             </div>
                             <div class="modal-footer">
                                    <input name="submit" value="Save" type="submit" class="btn btn-primary" form="bookmark">
                                    &nbsp;&nbsp;
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                             </div>
                       </div>
                 </div>
           </div>

         @endif
    </div>
</div>
@endif
