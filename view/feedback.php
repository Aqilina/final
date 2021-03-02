<?php //var_dump($comments) ?>

<header class="text-center m-4">

    <h2>CORPORE SANO</h2>
    <h5>Gym for your health</h5>
</header>

<!------------------------------------------------------------------------------------------>
<div class="feedback-container">
    <div class="comments-container my-4">
        <div class="text-start mb-2">What our clients say about us:</div>

<!--      COMMENTS AREA-->
 <div id="comments" class="comment-container"></div>
<!------------------------------------------------------------------------------->

        <?php if (!\app\core\Session::isUserLoggedIn()) : ?>

            <div>If you would like to share your opinion - please <a href="/login">login</a></div>
        <?php else: ?>
            <div class="text-start">Write comment:</div>
            <form action="" method="post">

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
                <button type="submit" class="btn btn-success" id="submitBtn">Comment</button>
            </form>


            <script>
                const commentsOutputEl = document.getElementById('comments')


                fetchComments()

                function fetchComments() {
                    fetch('/commentsGetFromDb')
                        .then(response => {
                            return response.json();
                        }).then(data => {
                            console.log(data);
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
                    commentsOutputEl.innerHTML = ''
                    commentsArr.forEach(function (commentObj) {
                        commentsOutputEl.innerHTML += generateOneComment(commentObj)
                    })
                }

            </script>


        <?php endif; ?>

    </div>
</div>





