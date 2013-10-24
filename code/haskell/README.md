## wat ##

0K, the HTTP-to-0MQ bridge.

## install ##

get [ghc][ghc] and the [haskell platform][hp]

(on unix, just do `aptitude install ghc cabal-install`)

cd here and:

_either_
  * `cabal install`
  * -> binaries in `~/.cabal/bin`

_or_
  * `cabal sandbox init`
  * `cabal install --only-dependencies`
  * `cabal configure`
  * `cabal build`
  * -> binaries here under `dist/`

server is `"0k"`, test client is `"ping"`

[ghc]: http://www.haskell.org/ghc/
[hp]: http://www.haskell.org/platform/
