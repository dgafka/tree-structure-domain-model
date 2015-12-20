## Tests for 3000 nodes

### For nodes kept as Doctrine/ArrayCollection
    
    Negative time for adding 3000 nodes: 2.9574508666992
    Memory usage (bytes) without nodes 1048576 memory usage with 3000 nodes 4456448 Diffrence: 3407872
    Unserializing 3000 objects time: 0.015481948852539
    Negative time for searching in 1000 nodes in first level: 0.0017478466033936
    Negative time for searching in 3000 nodes in deep levels: 0.012173891067505
    
### For nodes kept as simple array

    Negative time for adding 3000 nodes: 0.74792981147766
    Memory usage (bytes) without nodes 1048576 memory usage with 3000 nodes 3145728 Diffrence: 2097152
    Unserializing 3000 objects time: 0.0083379745483398
    Negative time for searching in 1000 nodes in first level: 0.0021910667419434
    Negative time for searching in 3000 nodes in deep levels: 0.0036070346832275