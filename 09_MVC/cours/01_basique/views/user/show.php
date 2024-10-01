<div class="container w-50">
  <div class="card p-4 border-0 shadow-sm">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Login</th>
          <th scope="col">Role</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <th role="row"><?= $user->getId() ?></th>
            <td ><?= $user->getLogin() ?></td>
            <td ><?= $user->getLibelle() ?></td>
            <td>
              <a href="userView.php?id=<?= $user->getId() ?>" class="me-3"><i class="bi bi-eye-fill"></i></a>
              <a href="userEdit.php?id=<?= $user->getId() ?>" class="me-3"><i class="bi bi-pencil-square"></i></a>
              <a href="userDelete.php?id=<?= $user->getId() ?>" class="me-3"><i class="bi bi-trash-fill text-danger"></i></a>
            </td>
          </tr>
      </tbody>
    </table>
  </div>
</div>
