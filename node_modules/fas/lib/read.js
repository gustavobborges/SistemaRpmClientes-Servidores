var fs = require('fs')
var ir = require('inquirer')
var cp = require('ncp')
var rm = require('rimraf')

module.exports = read;

function read(path, name) {
    var files = fs.readdirSync(path);
    var reg = /\{\{title\}\}/g;
    rm(name, function() {
        fs.mkdir(name, function() {
            files.forEach(function(filename) {
                var isDir = fs.lstatSync(path + filename).isDirectory();
                if (isDir) {
                    cp(path + filename, name + '/' + filename, {
                        stopOnErr: true
                    }, function(err) {
                        if (err) {
                            return console.log(err)
                        };
                        console.log('[!] 创建' + '资源文件完成')
                    })
                } else {
                    fs.readFile(path + filename, function(err, data) {
                        var html = data.toString().replace(reg, name)
                        if (!fs.existsSync(name + '/' + filename, html)) {
                            fs.writeFile(name + '/' + filename, html, function(err) {
                                console.log('[!] 创建' + filename + '文件完成')
                            })
                        } else {
                            fs.unlink(name + '/' + filename, function() {
                                fs.writeFile(name + '/' + filename, html, function(err) {
                                    console.log('[!] 创建' + filename + '文件完成')
                                })
                            })
                        }
                    })
                }
            })
        })
    })

}