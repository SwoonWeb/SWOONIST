<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group">
    <input type="text" class="form-control" placeholder="Search..." value="<?php echo get_search_query() ?>" name="s">
    <span class="input-group-btn">
      <button class="btn btn-secondary" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </span>
  </div>
</form>