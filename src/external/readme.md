Adding External librairies
==========================

External librairies must be added to src/external/.

Remote git repos can be added the following way : (example with twitter-bootstrap)

```
cd /path/to/My-Media-Tools
git remote add -f twitter-bootstrap git@github.com:twitter/bootstrap.git
git merge -s ours --no-commit twitter-bootstrap/master
git read-tree --prefix=src/external/twitter-bootstrap/ -u twitter-bootstrap/master
```
