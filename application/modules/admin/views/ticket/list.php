<div class="container-fluid">
   <div class="page-title-box box-spacing">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <h4 class="page-title">Tickets</h4>
            <ol class="breadcrumb">
               <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-12">
         <div class="row">
            <div class="col-lg-6 col-6">
               <div class="select filterSelect mb-3 mt-3 mr-4 ml-3">
                  <select name="slct" id="ticket-status">
                     <option selected disabled>Status</option>
                     <option value="">All</option>
                     <option value="0">Pending</option>
                     <option value="1">In Review</option>
                     <option value="2">Completed </option>
                  </select>
               </div>
            </div>
         </div>
         <table id="ticketList" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-spacing">
               <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created Date</th>
                  <th scope="col" class="text-right">Action</th>
               </tr>
            </thead>
         </table>
      </div>
      <!-- end col -->
   </div>
   <!-- end row -->
</div>
<!-- container-fluid -->
