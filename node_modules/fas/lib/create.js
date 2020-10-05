var fs = require('fs')
var ir = require('inquirer')
var cp = require('ncp')
var rm = require('rimraf')
var read = require('./read')

module.exports = branch;

function branch() {
    ir.prompt([{
        type: "input",
        name: "name",
        message: "请输入分支版本: "
    }], function(result) {
        if (result.name) {
            if (!result.name.match(/\d+.\d+/g)) {
                console.log('[!] 只能输入数字和点，且开头必须为数字')
                branch()
            };
            fs.exists(result.name, function(dir) {
                check(dir, result)
            })
        } else {
            console.log('[!] 分支名称不能为空')
            branch()
        }
    })
}


function check(dir, result) {
    if (dir) {
        ir.prompt([{
            type: 'confirm',
            name: 'replace',
            message: '目录 [' + result.name + '] 已经存在,是否覆盖？',
            default: true
        }], function(answer) {
            if (answer.replace) {
                create(result.name)
            } else {
                console.log('[!] 取消目录创建')
            }
        });
    } else {
        create(result.name)
    }
}


function create(result) {
    var dirs;
    var dirname = __dirname.replace(/\\lib/, '')
    ir.prompt([{
        type: "input",
        name: "name",
        message: "请输入获取资源文件的分支名: "
    }], function(a) {
        if(!fs.existsSync(a.name)){
            console.log('[!] 指定的分支不存在')
            create(result)
        }else{
            read(a.name + '\/', result)
        }
        
    })
}

