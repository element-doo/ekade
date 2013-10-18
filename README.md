get [ghc][ghc] and the [haskell platform][hp]

_either_ cd here, `cabal install`, binaries are in `~/.cabal/bin`

_or_ cd here, `cabal sandbox init`, `cabal install --only-dependencies`, `cabal
configure`, `cabal build`, binaries are here under `dist/`

server is 0k, test client is ping

[ghc]: http://www.haskell.org/ghc/
[hp]: http://www.haskell.org/platform/
