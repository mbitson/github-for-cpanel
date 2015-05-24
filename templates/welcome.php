<form class="layout-medium">
    <div class="form-group">
        <!--
        <div class="row">
            <div class="col-xs-12">
                <label for="provider-github">Please select a Git repo provider.</label>
            </div>
            <div class="col-xs-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="provider" id="provider-github" value="github" checked>
                        <span>GitHub</span>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="provider" id="provider-custom" value="custom" disabled>
                        <span>Custom Provider</span>
                    </label>
                </div>
            </div>
        </div>
        -->
        <div class="row">
            <div class="col-xs-12">
                <label for="repository">Repository Name</label>
            </div>
            <div class="col-xs-12">
                <div class="input-group">
                    <input type="text" placeholder="user/repository" class="form-control" id="repository">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label for="branch">Branch</label>
            </div>
            <div class="col-xs-12">
                <div class="input-group">
                    <input type="text" placeholder="master" class="form-control" id="branch">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label for="install-opt-composer">Installation Options</label>
            </div>
            <div class="col-xs-12">
                <div class="checkbox">
                    <input type="checkbox" id="install-opt-composer">
                </div>
            </div>
        </div>
    </div>
</form>