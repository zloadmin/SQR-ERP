<div>
    <form wire:submit.prevent="searchTasks">
        <!--- Search Field --->
        <div class="form-group">
            <input class="form-control form-control-light" type="text" wire:model="search_text" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-link">
            <i class="mdi mdi-search-web"></i>
        </button>
    </form>
</div>
