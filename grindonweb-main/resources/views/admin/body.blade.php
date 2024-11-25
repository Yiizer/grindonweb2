<h2 class="h1 no-margin-bottom" style="color: white;">Dashboard</h2>
</div>
</div>
<section class="no-padding-top no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block" style="background-color: #333; color: white; border-radius: 8px; padding: 15px;">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title" style="font-size: 16px;">
              <div class="icon" style="color: #999;"><i class="icon-user-1"></i></div><strong>Total Clients</strong>
            </div>
            <div class="number" style="font-size: 20px; color: #ddd;">{{$user}}</div>
          </div>
          <div class="progress progress-template" style="background-color: #555;">
            <div role="progressbar" style="width: 30%; background-color: #666;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template"></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block" style="background-color: #333; color: white; border-radius: 8px; padding: 15px;">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title" style="font-size: 16px;">
              <div class="icon" style="color: #999;"><i class="icon-contract"></i></div><strong>All Products</strong>
            </div>
            <div class="number" style="font-size: 20px; color: #ddd;">{{$product}}</div>
          </div>
          <div class="progress progress-template" style="background-color: #555;">
            <div role="progressbar" style="width: 70%; background-color: #888;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template"></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block" style="background-color: #333; color: white; border-radius: 8px; padding: 15px;">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title" style="font-size: 16px;">
              <div class="icon" style="color: #999;"><i class="icon-paper-and-pencil"></i></div><strong>Total Order</strong>
            </div>
            <div class="number" style="font-size: 20px; color: #ddd;">{{$order}}</div>
          </div>
          <div class="progress progress-template" style="background-color: #555;">
            <div role="progressbar" style="width: 55%; background-color: #aaa;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template"></div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="statistic-block block" style="background-color: #333; color: white; border-radius: 8px; padding: 15px;">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title" style="font-size: 16px;">
              <div class="icon" style="color: #999;"><i class="icon-writing-whiteboard"></i></div><strong>Delivered Products</strong>
            </div>
            <div class="number" style="font-size: 20px; color: #ddd;">{{$deliverd}}</div>
          </div>
          <div class="progress progress-template" style="background-color: #555;">
            <div role="progressbar" style="width: 35%; background-color: #bbb;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="footer" style="background-color: #333; color: white;">
  <div class="footer__block block no-margin-bottom">
    <div class="container-fluid text-center">
      <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      <p class="no-margin-bottom" style="font-size: 14px; color: #bbb;">2024 &copy; All Rights Reserved By GrindOn</p>
    </div>
  </div>
</footer>

<!-- Inline CSS adjustments for colors and display -->
<style>
  /* Progress bar adjustments */
  .progress-bar {
    transition: width 0.4s ease;
  }

  .progress-template .progress-bar {
    height: 8px;
    border-radius: 4px;
  }

  .progress-bar-template {
    background-color: #666; /* Default gray progress bar */
  }

  /* Hover effect on statistics blocks */
  .statistic-block:hover {
    background-color: #444;
    cursor: pointer;
  }

  /* Icon color adjustments */
  .icon {
    color: #bbb; /* Lighter gray for icons */
  }
</style>
