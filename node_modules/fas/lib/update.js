var fs = require('fs')
var path = require('path')
var ir = require('inquirer')

module.exports = update

function normalize(s) {
    return path.normalize(s)
}

function update() {
    var realpath = path.resolve(__dirname, '../', './assets')
    var gf = normalize(realpath + '/Gulpfile.js')
    var pkg = normalize(realpath + '/package.json')
    var pwd = path.resolve()
    var ifgf = fs.existsSync(normalize(pwd + '/Gulpfile.js'))
    var ifpkg = fs.existsSync(normalize(pwd + '/package.json'))

    if (ifgf || ifpkg) {
        ir.prompt([{
            type: 'confirm',
            name: 'replace',
            message: '配置文件已经存在,是否覆盖？',
            default: true
        }], function(answer) {
            if (answer.replace) {
                fs.unlink(normalize(pwd + '/Gulpfile.js'), function(err) {
                    if (err) {
                        console.log(err)
                        return;
                    }
                    fs.unlink(normalize(pwd + '/package.json'), function(err) {
                        if (err) {
                            console.log(err)
                            return;
                        }
                        copy()
                    })
                })
            } else {
                console.log('[!] 取消更新配置文件')
            }
        });
    } else {
        copy()
    }

    function copy() {
        fs.readFile(gf, function(err, data) {
            if (err) {
                console.log(err)
                return;
            }
            fs.writeFile(pwd + '/Gulpfile.js', data, function(err) {
                if (err) {
                    console.log(err)
                    return;
                }
                console.log('更新Gulpfile.js完成')
            })
        })
        fs.readFile(pkg, function(err, data) {
            if (err) {
                console.log(err)
                return;
            }
            fs.writeFile(pwd + '/package.json', data, function(err) {
                if (err) {
                    console.log(err)
                    return;
                }
                console.log('更新package.json完成')
            })
        })
    }
}
