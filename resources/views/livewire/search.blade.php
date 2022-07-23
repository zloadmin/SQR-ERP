<div>
    <div class="app-search dropdown d-none d-lg-block">
        <form wire:submit.prevent="searchTasks">
            <div class="input-group">
                <input type="text" class="form-control dropdown-toggle" placeholder="Search..." wire:model="search_text">
                <span class="mdi mdi-magnify search-icon"></span>
                <button class="input-group-text btn-primary" type="submit">Search</button>

            </div>
        </form>
    </div>
</div>
