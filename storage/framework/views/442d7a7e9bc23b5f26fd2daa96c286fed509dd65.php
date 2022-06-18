<!-- Message sending form -->
<div class="modal fade bs-example-modal-lg" id="message-compose-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Compose Message</h4>
            </div>
            <div class="modal-body">
                <?php echo Form::open(array('id' => 'compose-message1', 'route' => 'group.sent', 'method' => 'post', 'files' => false,'class'=>'form-horizontal')); ?>


                <div class="form-group required">
                   
                </div>

                <div class="form-group required">
                    <div class="col-md-4">
                        <?php echo Form::label('subject', trans('Subject'), ['class' => 'control-label']); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::text('subject', old('subject'), ['id'=>'subject', 'class'=>'form-control']); ?>

                    </div>
                </div>

                <div class="form-group required">
                    <div class="col-md-4">
                        <?php echo Form::label('message', old('Message'), ['class' => 'control-label']); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::textarea('message', old('message'), ['id'=>'message', 'class'=>'form-control']); ?>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <?php echo Form::submit(trans('Send Message'), ['class' => 'btn btn-primary']); ?>

                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($toUsername)): ?>
    <?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(window).on('load',function(){

            $('#message-compose-modal').modal('show');
        });
        $(document).ready(function () {
            //Generate Slug
            

            //Display CKEDITOR for content
            CKEDITOR.replace('message',
                {
                    toolbar: 'Standard', /* this does the magic */
                });
        });
    </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>