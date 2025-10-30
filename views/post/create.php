<main class="container py-4">
  <form method="post">
    <fieldset>
      <legend>Create New Post</legend>
      <p class="text-muted">Fill in the details below to create a new blog post.</p>

      <div class="d-flex flex-column gap-4">
        <div>
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div>
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
      </div>
    </fieldset>
  </form>
</main>
