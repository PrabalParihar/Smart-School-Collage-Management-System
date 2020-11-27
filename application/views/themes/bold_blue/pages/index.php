<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="container">
    <h1>Ajax Pagination in CodeIgniter Framework</h1>
    <div class="row">
        <div class="post-list" id="postList">
            <?php if (!empty($posts)): foreach ($posts as $post): ?>
                    <div class="list-item"><a href="javascript:void(0);"><h2><?php echo $post['language']; ?></h2></a></div>
                <?php endforeach;
            else:
                ?>
                <p>Post(s) not available.</p>
            <?php endif; ?>
<?php echo $this->ajax_pagination->create_links(); ?>
        </div>
        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url() . 'assets/images/loading.gif'; ?>"/></div></div>
    </div>
</div>