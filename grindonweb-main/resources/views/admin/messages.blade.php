<!DOCTYPE html>
<html>

<head>
  @include('admin.css')
</head>

<body>
  @include('admin.header')

  <!-- Sidebar Navigation-->
  @include('admin.sidebar')
  <!-- Sidebar Navigation end-->

  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h1 no-margin-bottom" style="color: white;">Client Messages</h2>
      </div>
    </div>

    <section class="no-padding-top">
      <div class="container-fluid">
        <div class="block">
          <div class="title">
            <strong>Messages</strong>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Message</th>
                  <th>Received At</th>
                </tr>
              </thead>
              <tbody>
                @foreach($messages as $message)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $message->name }}</td>
                  <td>{{ $message->email }}</td>
                  <td>{{ $message->phone }}</td>
                  <td>{{ $message->message }}</td>
                  <td>{{ $message->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- Display a message if no messages are found -->
          @if($messages->isEmpty())
          <p class="text-center">No messages found.</p>
          @endif
        </div>
      </div>
    </section>
  </div>

  <!-- JavaScript files-->
  @include('admin.js')
</body>

</html>
