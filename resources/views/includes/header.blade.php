<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="{{asset('temp/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('temp/css/stylesheet.css')}}">
    <link rel="stylesheet" href="{{asset('temp/css/boostrap.min.css')}}">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
    <link
      rel="icon"
      type="image/x-icon"
      href="{{asset('temp/assets/icons8-instagram-color-32.png')}}"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('page_title',env('APP_NAME') )</title>
  </head>
  <body>
    <header
      class="d-flex flex-wrap justify-content-center py-2 mb-4 border-bottom">
      <div class="container">
        <div
          class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"
        >
          <a
            href="/"
            class="d-flex align-items-center mb-2 ms-lg-5 mb-lg-0 text-dark text-decoration-none"
          >
            <img class="logo" src="{{asset('temp/assets/7a252de00b20.png')}}" alt="instagram" />
          </a>
          <!-- Search -->
          <form
            class="col-12 col-lg-auto mb-3 ms-lg-auto mb-lg-0 me-lg-3"
            role="search"
          >
            <input
              type="search"
              class="form-control search"
              placeholder="Search"
              aria-label="Search"
            />
          </form>
          <!-- End Search -->

          <!-- Menu Items -->
          <ul
            class="nav col-12 col-lg-auto me-lg-3 ms-lg-auto mb-2 justify-content-center mb-md-0"
          >
            <li>
              <a href="#" class="nav-link px-2 link-dark">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  class="bi bi-house-door"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"
                  />
                </svg>
              </a>
            </li>
            <li>
              <button type="button"  data-bs-toggle="modal" class="nav-link px-2 link-dark button" data-bs-target="#Modal1">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="currentColor"
                  class="bi bi-plus-circle"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"
                  />
                  <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
                  />
                </svg>
              </button>
            </li>
          </ul>
          <!-- End Menu Items -->

          <!-- User -->
          <div class="dropdown text-end">
            <a
              href="#"
              class="d-block link-dark text-decoration-none"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <img
                src="{{ auth()->user()->avatar != null ? \Storage::url(auth()->user()->avatar) : asset('temp/assets/no pic.jpg')}}"
                alt="mdo"
                width="28"
                height="28"
                style="object-fit:cover ;"
                class="rounded-circle"
              />
            </a>
            <ul class="dropdown-menu text-small">
              <li><a class="dropdown-item" href="#">Profile </a></li>
              <li><a class="dropdown-item" href="#">Saved</a></li>
              <li><a class="dropdown-item" href="{{ROUTE('users.edit')}}">Settings</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <form action="{{ROUTE('logout')}}" method="post">
                  @csrf
                  <button class="dropdown-item">Log Out</button>
                </form>                
                </li>
            </ul>
          </div>
          <!-- End User -->
        </div>
      </div>
      
      <!-- Modal -->
      <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="createPost">Create New Post</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row">
                  <!-- Slide -->
                  <div id="first-carousel" class="carousel slide  w-100" data-bs-ride="false">
                    <div class="first-carousel carousel-inner ">
                 
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#first-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#first-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"  aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
                </div>
                     <!-- End Slide -->
                <div class="row">
                  <p class="opacity-50 w-100  m-auto mt-3 text-center">
                    Drag photos and videos here
                  </p>
                  </div>
                  <!-- Post Form -->
                <form method="POST" action="#">
                <div class="row">
                   <div class="mt-3 text-center" >
                  <label class="btn btn-primary opacity-100 w-50  btn-sm">
                    Select from computer <input type="file" id="file" hidden multiple>
                  </label>
                </div>
                <div class="mt-3">
                  <textarea class="form-control" id="caption" rows="3" name="caption" placeholder="Write a caption..."></textarea>
                </div>
                </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"   data-bs-dismiss="modal">Share</button>
            </div>
          </form>
           <!-- End Post Form -->
          </div>
        </div>
      </div>
      <!-- End Modal -->
    </header>