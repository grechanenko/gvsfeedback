<h3 class="page-product-heading">Product Comments</h3>
<div class="rte">
    {foreach from=$comments item=comment}
    <p>
        <strong>Comment #{$comment.id_gvs_comment}:</strong>
        {$comment.comment}<br>
        <strong>Grade:</strong> {$comment.grade}/5<br>
    </p><br>
    {/foreach}
</div>

<div class="rte">
    {if $enable_grades eq 1 OR $enable_comments eq 1}
    <form action="" method="POST" id="comment-form">
        {if $enable_grades eq 1}
        <div class="form-group">
            <label for="grade">Grade:</label>
            <div class="row">
                <div class="col-xs-4">
                    <select id="grade" class="form-control" name="grade">
                        <option value="0">-- Choose --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
        </div>
        {/if}

        {if $enable_comments eq 1}
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>
        {/if}

        <div class="submit">
            <button type="submit" name="gvs_tpc_submit_comment" id="gvs_tpc_submit_comment" class="button btn btn-default button-medium">
                <span>Send<i class="iconchevron-right right"></i></span>
            </button>
        </div>
    </form>
    {/if}
</div>