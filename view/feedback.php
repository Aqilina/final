<?php var_dump($comments[0]->name) ?>

<header class="text-center m-4">

    <h2>CORPORE SANO</h2>
    <h5>Gym for your health</h5>
</header>

<!------------------------------------------------------------------------------------------>
<div class="feedback-container">
    <div class="comments-container my-4">
        <div class="text-start mb-2">What our clients say about us:</div>

        <?php if (!\app\core\Session::isUserLoggedIn()) : ?>
            <?php foreach ($comments as $comment) : ?>
            <div class="comments card card-body mb-4">
                <div class="oneComment text-start">
                    <p class=""><?php echo $comment->name ?></p>
                    <p class="text-muted"><?php echo $comment->comment ?></p>
                    <p class="text-muted"><?php echo $comment->created_at ?></p>
                </div>
            </div>
        <?php endforeach; ?>
            <div>If you would like to share your opinion - please <a href="/login">login</a></div>
        <?php else: ?>

            <!------------------------------------------------------------------------------->

            <!--      COMMENTS AREA-->
            <div id="comments" class="comment-container"></div>

            <div class="text-start">Write comment:</div>
            <form action="" method="post" id="commentForm">

                <div class="form-group">
                    <input id="name" type="text" name="name"
                           class="<?php echo (!empty($errors['nameErr'])) ? 'is-invalid' : ''; ?> form-control"
                           placeholder="Your name"
                           value="<?php echo $_SESSION['user_name'] ?>">
                    <span class='invalid-feedback'><?php echo $errors['nameErr'] ?></span>
                </div>

                <div class="form-group my-2">
                    <textarea id="comment"
                              class="<?php echo (!empty($errors['commentErr'])) ? 'is-invalid' : ''; ?> form-control"
                              type="text" name="comment"
                              placeholder="Write your comment"></textarea>
                    <span class='invalid-feedback'><?php echo $errors['commentErr'] ?></span>
                </div>
                <button disabled type="submit" class="btn btn-success" id="submitBtn">Comment</button>
            </form>


            <script>
                const commentsContainer = document.getElementById('comments')
                const commentForm = document.getElementById('commentForm')
                const name = document.getElementById('name')
                const comment = document.getElementById('comment')

                const submitBtn = document.getElementById('submitBtn')

                commentForm.addEventListener('submit', addCommentAsync)
                name.addEventListener('input', clearErrorsOnInput);
                comment.addEventListener('input', clearErrorsOnInput);


                fetchComments()

                function fetchComments() {
                    fetch('/commentsGetFromDb')
                        .then(response => {
                            return response.json();
                        }).then(data => {
                        console.log(data.comments);
                        generateHTMLComments(data.comments)
                    });
                }

                function generateOneComment(oneComment) {
                    return `
        <div class="comments card card-body mb-4">
            <div class="oneComment text-start">
                <p class="">${oneComment.name}</p>
                <p class="text-muted">${oneComment.comment}</p>
                <p class="text-muted">${oneComment.created_at}</p>
            </div>
        </div>
`
                }

                function generateHTMLComments(commentsArr) {
                    commentsContainer.innerHTML = ''
                    commentsArr.forEach(function (commentObj) {
                        commentsContainer.innerHTML += generateOneComment(commentObj)
                    })
                }

                // --------------------------------------------------------------------------------------------------------------------

                function addCommentAsync(event) {
                    event.preventDefault();
                    resetErrors()

                    const addCommentFormData = new FormData(commentForm)

                    fetch('/addComment', {
                        method: 'post',
                        body: addCommentFormData
                    }).then(response => {
                        return response.json();
                    }).then(data => {
                        // console.log(data);
                        if (data.success) {
                            handleSuccessComment();
                        } else {
                            handleCommentError(data.errors)
                        }
                    }).catch(error => console.error(error))
                }

                function handleSuccessComment() {
                    comment.value = '';
                    fetchComments();
                }

                function handleCommentError(errorObj) {
                    console.log(errorObj)
                    submitBtn.setAttribute('disabled', '')

                    if (errorObj.commentErr) {
                        comment.classList.add('is-invalid');
                        comment.nextElementSibling.innerHTML = errorObj.commentErr;
                    } else if (errorObj.nameErr) {
                        comment.classList.add('is-invalid');
                        comment.nextElementSibling.innerHTML = errorObj.nameErr;
                    }
                }

                function resetErrors() {
                    // search form for al is-inavlid clases and remove them
                    const errorEl = commentForm.querySelectorAll('.is-invalid');
                    errorEl.forEach((errorInputEl) => errorInputEl.classList.remove('is-invalid'));
                }

                function clearErrorsOnInput(event) {
                    const stringLength = event.target.value.length;

                    if (stringLength > 1) {
                        event.target.classList.remove('is-invalid');
                        submitBtn.removeAttribute('disabled');
                    } else {
                        submitBtn.setAttribute('disabled', '');
                    }
                }

            </script>


        <?php endif; ?>

    </div>
</div>





