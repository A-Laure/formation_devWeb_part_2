<nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'home' ? 'active' : '' ?>" aria-disabled="true">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'users' ? 'active' : '' ?>" href="usersList.php">Liste des utilisateurs</a>
          </li>
          
          
        </ul>

        <form class="d-flex" role="search" method="post" action="search.php">
          <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="search">
          <select class="form-select" aria-label="Default select example" name="filter">
            <option selected value="all" >All</option>
            <option value="users">Users</option>
            <option value="posts">Posts</option>
          </select>

          <button class="btn btn-outline-primary" type="submit">Rechercher</button>
        </form>

      </div>
    </div>
  </nav>