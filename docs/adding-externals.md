git remote add -f twitter-bootstrap git@github.com:twitter/bootstrap.git
git merge -s ours --no-commit twitter-bootstrap/master
git read-tree --prefix=external/twitter-bootstrap/ -u twitter-bootstrap/master
